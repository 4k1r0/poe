/**
 * Created by matthieu on 28/01/2017.
 */
import {Component} from '@angular/core';
import {PoeApiService} from "../services/poe-api.service";

@Component({
    selector: 'my-stash-poe',
    templateUrl: 'app/components/my-stash-poe.component.html'
})
export class MyStashPoeComponent {

    accountname: string;

    constructor(private poeApiService: PoeApiService){

    }

    onClick(){
        console.log('onclick');
        this.poeApiService.crawl();
    }
}