/**
 *
 * Sub-components are:
 * 		<NONE>
 *
 * Props are:
 * 		message:
 * 		messageType:
 *
 * Used by:
 *  	ShareBlock
 *
 * Uses context: LightboxContext
 */
import React from "react";
import ReactDOM from "react-dom";
import { LightboxContext } from '../../../Lightbox';

class SetUserListMessage extends React.Component {
	constructor(props) {
		super(props);
		SetUserListMessage.contextType = LightboxContext;
	}

	render() {
		return (
			(this.props.message) ? <div className={`alert alert-${(this.props.messageType == 'error') ? 'danger' : 'success'}`}>{this.props.message}</div> : null
		);
	}
}

export default SetUserListMessage;