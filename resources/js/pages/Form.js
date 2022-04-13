import React, { Component } from 'react';
import ReactDOM from "react-dom";
import axios from "axios";

class Form extends Component {
    constructor(props){
        super(props);

        this.state = {
            name : '',
            friend_name : '',
            friend_email : '',
        }

        this.getName = this.getName.bind(this);
        this.getFriendName = this.getFriendName.bind(this);
        this.getFriendEmail = this.getFriendEmail.bind(this);

        this.handleSubmit = this.handleSubmit.bind(this);
    }

    getName(event){
        this.setState({name : event.target.value})
    }

    getFriendName(event){
        this.setState({friend_name : event.target.value})
    }

    getFriendEmail(event){
        this.setState({friend_email : event.target.value})
    }

    handleSubmit(e) {
        e.preventDefault();
        const token = document.querySelector('meta[name="csrf-token"]');

        const data = {
            name:  this.state.name,
            friend_name: this.state.friend_name,
            friend_email: this.state.friend_email,
        };

        axios.post('api/sendrequest', data, {
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token.content
                }
            })
            .then(
                response => alert(JSON.stringify(response.data))
            )
            .catch(error => {
                console.log("ERROR:: ",error.response.data);
            });
    }

    render () {
        const token = document.querySelector('meta[name="csrf-token"]');
        return (
            <div className="container-fluid">
                <main>
                    <section className={'content-form'}>
                        <h1>Send to a friend</h1>
                        <h5>Share this great deal with friends!</h5>

                        <div>
                            <form>
                                <input type="hidden" name="_token" value={token.content} />

                                <div className="form-group row">
                                    <label htmlFor="name" className="col-6 col-form-label">Your name *</label>
                                    <div className="col-6">
                                        <input type="text" className="form-control-plaintext" id="name" name="name" required onChange={this.getName}/>
                                    </div>
                                </div>
                                <div className="form-group row">
                                    <label htmlFor="friend_name" className="col-6 col-form-label">Friend's name *</label>
                                    <div className="col-6">
                                        <input type="text" className="form-control-plaintext" id="friend_name" name="friend_name" required onChange={this.getFriendName}/>
                                    </div>
                                </div>
                                <div className="form-group row">
                                    <label htmlFor="friend_email" className="col-6 col-form-label">Friend's email *</label>
                                    <div className="col-6">
                                        <input type="email" className="form-control-plaintext" id="email" name={'friend_email'} required onChange={this.getFriendEmail}/>
                                    </div>
                                </div>
                                <div className="row">
                                    <div className="col-6 offset-6">
                                        <button type="submit" value="submit" id="submit" onClick={this.handleSubmit}>
                                            <span>&#x2192;</span> SUBMIT
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </section>
                </main>
            </div>
        );
    }
}

export default Form;

if (document.getElementById('form')) {
    ReactDOM.render(<Form />, document.getElementById('form'));
}
