/**
 * Created by matthieu on 28/01/2017.
 */
import {Injectable} from '@angular/core';
import {ConfigService} from "./config.service";
import {Http} from '@angular/http';

import 'rxjs/add/operator/map';
import 'rxjs/add/operator/toPromise';

@Injectable()
export class PoeApiService {

    constructor(private http: Http, private config: ConfigService) {
    }

    crawl() {
        this.http.get(this.config.publicStashTagUrl)
            .toPromise()
            .then(response => {
                console.log(response);
                // response.json().data as Hero[]
            })
            .catch(this.handleError);

    }

    private handleError(error: any): Promise<any> {
        console.error('An error occurred', error); // for demo purposes only
        return Promise.reject(error.message || error);
    }

    getJSON = function (url: string) {
        return new Promise(function (resolve, reject) {
            var xhr = new XMLHttpRequest();
            xhr.open('get', url, true);
            xhr.responseType = 'json';
            xhr.onload = function () {
                var status = xhr.status;
                if (status == 200) {
                    resolve(xhr.response);
                } else {
                    reject(status);
                }
            };
            xhr.send();
        });
    };
}