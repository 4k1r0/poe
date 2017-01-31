"use strict";
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};
/**
 * Created by matthieu on 28/01/2017.
 */
var core_1 = require('@angular/core');
var config_service_1 = require("./config.service");
var http_1 = require('@angular/http');
require('rxjs/add/operator/map');
require('rxjs/add/operator/toPromise');
var PoeApiService = (function () {
    function PoeApiService(http, config) {
        this.http = http;
        this.config = config;
        this.getJSON = function (url) {
            return new Promise(function (resolve, reject) {
                var xhr = new XMLHttpRequest();
                xhr.open('get', url, true);
                xhr.responseType = 'json';
                xhr.onload = function () {
                    var status = xhr.status;
                    if (status == 200) {
                        resolve(xhr.response);
                    }
                    else {
                        reject(status);
                    }
                };
                xhr.send();
            });
        };
    }
    PoeApiService.prototype.crawl = function () {
        this.http.get('api/get')
            .toPromise()
            .then(function (response) {
            console.log(response);
            // response.json().data as Hero[]
        })
            .catch(this.handleError);
    };
    PoeApiService.prototype.handleError = function (error) {
        console.error('An error occurred', error); // for demo purposes only
        return Promise.reject(error.message || error);
    };
    PoeApiService = __decorate([
        core_1.Injectable(), 
        __metadata('design:paramtypes', [http_1.Http, config_service_1.ConfigService])
    ], PoeApiService);
    return PoeApiService;
}());
exports.PoeApiService = PoeApiService;
//# sourceMappingURL=poe-api.service.js.map