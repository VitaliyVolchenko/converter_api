import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';

export default class Converter extends Component {

    constructor(props) {
        super(props);
        this.state = {numberToSend: null, result: null, error: null}
        this.convertNumberHandler = this.convertNumberHandler.bind(this)
        //this.typeNumberHandler = this.typeNumberHandler.bind(this);
    }

    convertNumberHandler () {
        console.log('TTT', this.state.numberToSend);
        axios.post('api/converter', {number: this.state.numberToSend})
        .then(res => {
            console.log('RESSSS', res);
            if (res.data.error) {
                this.setState({
                    error: 'Something went wrong'
                })
            } else {
                this.setState({result: res.data})
            }            
        })             
    }

    typeNumberHandler(e) {
        this.setState({
            numberToSend: e.target.value
        });
        console.log(e);
    }

    render() {
        console.log(this.state.result);
        return (
            <div className="container">
                <div className="row justify-content-center">
                    <div className="col-md-8 mb-3">
                        <div className="card">
                            <div className="card-header">Web application that allows you to convert numbers from Roman to Arabic and vice versa</div>                            
                        </div>
                    </div>
                    {this.state.error ? <div className="col-md-8 text-danger">
                        {this.state.error}
                    </div> : null}
                    
                    <div className="col-md-8 d-flex justify-content-between">
                        <input type="text" style={{ maxWidth: '270px', width: '100%', height: '100px' }} className="form-control mr-3" onChange={(e) => this.typeNumberHandler(e)} placeholder="Enter arabic or roman number"/>
                        <button className="btn btn-success mr-3" onClick={this.convertNumberHandler}>Convert</button>
                        <div className="card" style={{ maxWidth: '270px', width: '100%', padding: '10px', display: 'flex', justifyContent: 'center' }}>{this.state.result ? this.state.result : 'waiting for number...'}</div>
                    </div>
                </div>
            </div>
        );
    }
}

if (document.getElementById('converter')) {
    ReactDOM.render(<Converter />, document.getElementById('converter'));
}
