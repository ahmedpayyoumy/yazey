'use strict'

const util = require('util')
var axios = require('axios');

const API_URL = process.env.URL || 'http://crm2.local'

module.exports = {
    sendMessage: (req, res) => {
        let data = req.body;
        var messageData = JSON.stringify(data);
        var config = {
            method: 'post',
            url: API_URL + '/api/facebook/broadcast/send',
            headers: {
                'Content-Type': 'application/json'
            },
            data : messageData
        };

        axios(config)
        .then(function (response) {
            console.log(response);
        })
        .catch(function (error) {
            console.log(error);
        });
        res.json({
            "status": 1,
            "message" : "received request successfully"
        });
    },
}
