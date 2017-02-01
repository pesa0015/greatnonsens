var socket = io.connect( 'http://'+window.location.hostname+':3000' );
socket.emit('test', moment().format('LLLL'));
socket.on('test2', function(msg){
	console.log(msg);
});

import React from '../../node_modules/react';
import ReactDOM from '../../node_modules/react-dom';

// var fetch = require('../node_modules/whatwg-fetch');

function parseJSON(response) {
  	return response.json()
}
function checkResult(result) {
  	return result.success;
}

// fetch('api/test',{method:'POST',body: {test:'test'}}).then(parseJSON).then(checkResult).then(function(data){console.log(data);});

class CreateStoryForm extends React.Component {
	constructor(props) {
		super(props);
		this.state = {title: '', words: '', rounds: 5, max_writers: 10, open_for_everyone: 1, errors: true};
		this.handleTitleChange = this.handleTitleChange.bind(this);
        this.handleWordsChange = this.handleWordsChange.bind(this);
        this.handleRoundsChange = this.handleRoundsChange.bind(this);
        this.handleWritersChange = this.handleWritersChange.bind(this);
        this.makeStoryPublic = this.makeStoryPublic.bind(this);
        this.onlyInvitation = this.onlyInvitation.bind(this);
		this.handleLogin = this.handleLogin.bind(this);
	}
	handleTitleChange(e) {
   		this.setState({title: e.target.value});
	}
	handleWordsChange(e) {
   		this.setState({words: e.target.value});
	}
	handleRoundsChange(e) {
   		this.setState({rounds: e.target.value});
	}
	handleWritersChange(e) {
   		this.setState({max_writers: e.target.value});
	}
	makeStoryPublic() {
   		this.setState({open_for_everyone: 1});
	}
    onlyInvitation() {
        this.setState({open_for_everyone: 0});
    }
	handleLogin(e) {
		this.setState({errors: false});
	    fetch('api/test', {
	    	method: 'POST',
            headers: {  
                'Content-type': 'application/x-www-form-urlencoded; charset=UTF-8'
            },   
	    	body: 'data=' + JSON.stringify(this.state)
	    })
	    // .then(parseJSON)
	    // .then(checkResult)
	    .then(response => response.json())
  .then(json => {
    console.log(json) // access json.body here
  })
	    e.preventDefault();
     console.log(JSON.stringify(this.state));
	}
	render() {
	    return (
	        <form onSubmit={this.handleLogin} method="POST">
                <input type="text" name="title" onChange={this.handleTitleChange} />
	          	<textarea onChange={this.handleWordsChange} />
                <input type="number" name="rounds" onChange={this.handleRoundsChange} />
                <input type="number" name="writers" onChange={this.handleWritersChange} />
                <input type="radio" name="public" onChange={this.makeStoryPublic} />
                <input type="radio" name="invitation" onChange={this.onlyInvitation} />
	          	<input type="submit" value="Login" />
	        </form>
	    )
	}
}

const modals = {
	'join-story': <h1>Test</h1>,
	'create-story': <CreateStoryForm />
};

(function(){
	var modal = document.getElementById('modal');
	var modalButtons = document.getElementsByClassName('show-modal');
	var modalOverlay = document.getElementById('modal-overlay');
	for (var i = 0; i < modalButtons.length; i++) {
		modalButtons[i].onclick = function() {
			var currentModal = this.getAttribute('data-modal');
			ReactDOM.render(
  				modals[currentModal], document.getElementById('modal-content')
			);
			modal.className += ' md-show';
			modalOverlay.onclick = function() { modal.className = 'md-modal md-effect-12'; }
		}
	}
})();

class ReadIcon extends React.Component {
	constructor(props) {
		super(props);
		this.state = {stories: 0};
	}
	render() {
		return (
			<div className="top-nav-shortcut-item">
				<span id="toggle-read">
                    <span className="icon-text">Läs</span>
                    <img src="images/book.png" id="read" alt="" />
                    <span id="nr-read" className="nr-show">15</span>
            	</span>
                <div id="header-read" className="dropdown">
                	<ul>
                		<li>Test</li>
                		<li>Test</li>
                	</ul>
                </div>
            </div>
		)
	}
}

class WriteIcon extends React.Component {
	constructor(props) {
		super(props);
		this.state = {type: props.type, text: props.text, img: props.img, stories: 0};
	}
	render() {
		return (
			<div className="top-nav-shortcut-item">
				<span id="toggle-read">
                    <span className="icon-text">Skriv</span>
                    <img src="images/pen-black.png" id="write" alt="" />
                    <span id="nr-write" className="nr-show">15</span>
            	</span>
                <div id="header-write" className="dropdown">
                	<ul>
                		<li>Test</li>
                		<li>Test</li>
                	</ul>
                </div>
            </div>
		)
	}
}

class NewsIcon extends React.Component {
	constructor(props) {
		super(props);
		this.state = {type: props.type, text: props.text, img: props.img, stories: 0};
	}
	render() {
		return (
			<div className="top-nav-shortcut-item">
				<span id="toggle-news">
                    <span className="icon-text">Nyheter</span>
                    <img src="images/alert-big.png" id="news" alt="" />
                    <span id="nr-news" className="nr-show">15</span>
            	</span>
                <div id="header-news" className="dropdown">
                	<ul>
                		<li>Test</li>
                		<li>Test</li>
                	</ul>
                </div>
            </div>
		)
	}
}

class MenuIcon extends React.Component {
	constructor(props) {
		super(props);
		this.state = {display: false};
		// this.handleClick = this.handleClick.bind(this);
	}
	// handleClick() {
	// 	var visibility = this.state.display ? false : true;
	// 	this.setState({display: visibility});
	// }
	render() {
		var show = this.state.display ? 'show' : 'hide';
		return (
			<div className="top-nav-shortcut-item">
				<span id="toggle-menu">
                    <img src="images/menu.png" id="menu" alt="" />
            	</span>
            	<div id="menu" className="dropdown">
            		<ul id="nav">
            			<li>Min profil</li>
            		</ul>
            	</div>
            </div>
		)
	}
}

class HeaderIcons extends React.Component {
	constructor(props) {
		super(props);
	}
	render() {
		return (
			<div>
				<ReadIcon />
				<WriteIcon />
				<NewsIcon />
				<MenuIcon />
			</div>
		)
	}
}

ReactDOM.render(
  	<HeaderIcons />, document.getElementById('header-icons')
);