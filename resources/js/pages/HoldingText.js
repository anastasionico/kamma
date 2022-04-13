import React from 'react';
import ReactDOM from 'react-dom';
import Title from "../layout/Title";
import Content from "../layout/Content";
import Footer from "../layout/Footer";

function HoldingText() {
    return (
        <div className="container-fluid">
            <div className={'bg-grey'}></div>

            <main>
                <Title/>
                <Content/>
                <Footer/>
            </main>

            <div className={'bg-grey'}></div>
        </div>
    );
}

export default HoldingText;

if (document.getElementById('holding_text')) {
    ReactDOM.render(<HoldingText />, document.getElementById('holding_text'));
}
