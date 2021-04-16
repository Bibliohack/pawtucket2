'use strict';
import React from 'react';
import ReactDOM from 'react-dom';
const axios = require('axios');
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let selectors = pawtucketUIApps.exhbrowse;

console.log("PUIAPPS exhbrowse: ", pawtucketUIApps.exhbrowse);

class ExhBrowse extends React.Component {
  constructor(props) {
    super(props); 
    this.state = {
    	'results': [], 
    	'navItem': null,
		'value': '',
		'sortDirection': 'ASC'
    };

    this.setBrowseResults = this.setBrowseResults.bind(this);
    this.setSortDirection = this.setSortDirection.bind(this);
  }
  
  setBrowseResults(navItem, data) {
  	this.setState({'navItem': navItem , 'results': data, 'value': navItem.props.value});
  }

  setSortDirection(s) {
  	let state = this.state;
  	state.sortDirection = (s === 'DESC') ? 'DESC' : 'ASC';
  	this.setState(state);
  }

  render() {
  	let results = [], resultsByYear = [], lastYear = null;
  	let hits = [...this.state.results];
  	if (this.state.sortDirection === 'DESC') { hits = hits.reverse(); }

  	let isOpen = true;
  	for(var k in hits) {
  		let result = hits[k];
  		if(this.props.groupByYear) {
  			let curYear = parseInt(result.year);
  			if(lastYear === null) { lastYear = curYear; }

			if (curYear !== lastYear) {
				results.push(<ExhBrowseResultByYear key={lastYear} open={isOpen} results={resultsByYear} year={lastYear}/>);

				resultsByYear = [];
				lastYear = curYear;
				isOpen = false;
			}
			resultsByYear.push(<ExhBrowseResultItem key={result.detail_link} detailLink={result.detail_link}/>);
		} else {
			results.push(<ExhBrowseResultItem key={result.detail_link} detailLink={result.detail_link}/>);
		}
  	}

	  if (this.props.groupByYear && (resultsByYear.length > 0) && (lastYear > 0)) {
		  results.push(<ExhBrowseResultByYear open={isOpen} results={resultsByYear} year={lastYear}/>);
	  }

	  let colClass = (this.props.groupByYear > 0) ? "xxx" : "card-columns";

    return (
    	<div>
			<div className="row justify-content-center">
				<div className="col-sm-12 col-md-12 text-center">       	
					<ul className="sortby"><ExhBrowseNavigation facetUrl={this.props.facetUrl} browseUrl={this.props.browseUrl} handleResults={this.setBrowseResults} /></ul>
				</div>
			</div>
				
			<div className="nameBrowse">
				<div className="row justify-content-center"><h2>{this.state.value}</h2></div>
				<div className={colClass}>
					<ul className="select-list browseResults">		
					{results}
					</ul>
				</div>
			</div>
		</div>
    );
  }
}

class ExhBrowseResultByYear extends React.Component {
	constructor(props) {
		super(props);

		this.state = {
			open: this.props.open
		}

		this.doToggle = this.doToggle.bind(this);
		this.componentDidUpdate = this.componentDidUpdate.bind(this);
	}

	doToggle(e) {
		let state = this.state;
		state.open = !state.open;
		this.setState(state);
		e.preventDefault();
	}

	componentDidUpdate(prevProps, prevState, snapshot) {
		if(this.props.year !== prevProps.year) {
			let state = this.state;
			state.open =  this.props.open;
			this.setState(state);
		}
	}

	render() {
		let styles = {
			display: this.state.open ? 'block' : 'none'
		};
		let arrow = this.state.open ? "↑" : "↓";
		return(<ul className="list-unstyled">
			<li className="masonry-title--byYear dateBrowseHeader">
				<a href='#' onClick={this.doToggle}>{this.props.year} {arrow}</a>
				<div class="card-columns">
					<ul className="list-unstyled" style={styles}>{this.props.results}</ul>
				</div>
			</li>
		</ul>);
	}
}

class ExhBrowseResultItem extends React.Component {
	constructor(props) {
		super(props);
	}

	render() {
		return(<li className="masonry-title--byYear" dangerouslySetInnerHTML={{ __html : this.props.detailLink }}></li>);
	}
}

class ExhBrowseNavigation extends React.Component {
  constructor(props) {
    super(props); 
    this.state = {'navItems': null, 'navItemRefs': [], 'selected': null};

    this.handleClick = this.handleClick.bind(this);
  }

  componentDidMount() {
  	let that = this;

  	// Fetch browse facet items
	axios.get(this.props.facetUrl)
	.then(function (response) {
		let navItems = [], navItemRefs = [];
		for(var k in response.data) {
			let navItem = response.data[k];
			let r = React.createRef();
			navItemRefs.push(r);
			navItems.push(<ExhBrowseNavigationItem ref={r} label={navItem.label} value={navItem.id} key={navItem.id} browseUrl={that.props.browseUrl} handleClick={that.handleClick}/>);
		}
		that.setState({'navItems': navItems, 'navItemRefs': navItemRefs});
	})
	.catch(function (error) {
		console.log("Error while loading browse navigation: ", error);
	})
  }

  componentDidUpdate(prevProps, prevState, snapshot) {
	  if (this.state.selected === null) {
	  	this.state.navItemRefs[0].current.loadFacetResults();
	  }
  }

	handleClick(navItem, data) {
	if(this.state.navItems === null) { return; }

	for(var k in this.state.navItemRefs) {
		this.state.navItemRefs[k].current.isSelected(false);
	}
	navItem.isSelected(true);

	let state = this.state;
	state['selected'] = navItem;
	this.setState(state);

	this.props.handleResults(navItem, data);
  }

  render() {
  	if(this.state.navItems === null) { return ""; }	// Don't render prior to load

    return (
      <ul className="browseNav">
        {this.state.navItems}
      </ul>
    );
  }
}

class ExhBrowseNavigationItem extends React.Component {
  constructor(props) {
    super(props); 
    this.state = {
    	"selected": false
	};

    this.loadFacetResults = this.loadFacetResults.bind(this);
    this.isSelected = this.isSelected.bind(this);
  }

  // Load results when navigation item is clicked
  loadFacetResults(e=null) {
  	if (e !== null) { e.preventDefault(); }

  	let that = this;
	axios.get(decodeURI(this.props.browseUrl).replace("%value", escape(this.props.value)))
	.then(function (response) {
		that.props.handleClick(that, response.data);
	})
	.catch(function (error) {
		console.log("Error while loading facet data: ", error);
	});
  }

  isSelected(s) {
  	s = !!s;
  	this.setState({"selected": s});
  }

  render() {
    return (
     <li className="browseNavItem">
       	<a href="#" onClick={this.loadFacetResults} className={this.state["selected"] ? "browseNavItemSelected" : ""}>{this.props.label}</a>
      </li>
    );
  }
}


//---------------Not being used-----------------
class ExhBrowseSortButton extends React.Component {
	constructor(props) {
		super(props);
		this.state = {
			"sortDirection": 'ASC'
		};

		this.toggleSortDirection = this.toggleSortDirection.bind(this);
	}

	toggleSortDirection() {
		if (this.state.sortDirection === 'ASC') {
			this.setState({"sortDirection": 'DESC'});
			this.props.doSort('DESC');
		} else {
			this.setState({"sortDirection": 'ASC'});
			this.props.doSort('ASC');
		}
	}

	render() {
		let r = (this.state.sortDirection === 'DESC') ? "rotate(0deg)" : "rotate(180deg)";
		return (
			<img src="/themes/sva/assets/pawtucket/graphics/sharp-arrow_drop_down-24px.svg" style={{transform: r}} onClick={this.toggleSortDirection}/>
		);
	}
}

export default function _init() {
	for(var k in selectors) {
		ReactDOM.render(<ExhBrowse facetUrl={selectors[k].facetUrl} browseUrl={selectors[k].browseUrl} groupByYear={selectors[k].groupByYear}/>, document.querySelector(k));
	}
}
