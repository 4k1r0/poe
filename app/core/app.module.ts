import {NgModule}      from '@angular/core';
import {BrowserModule} from '@angular/platform-browser';
import {FormsModule}   from '@angular/forms';
import {HttpModule}    from "@angular/http";

import {AppComponent}  from './app.component';

import {MyStashPoeComponent} from '../components/my-stash-poe.component';
import {ConfigService} from "../services/config.service";
import {PoeApiService} from "../services/poe-api.service";

@NgModule({
    imports: [
        BrowserModule,
        FormsModule,
        HttpModule
    ],
    declarations: [
        AppComponent,
        MyStashPoeComponent
    ],
    providers: [
        ConfigService,
        PoeApiService,
    ],
    bootstrap: [
        AppComponent
    ]
})
export class AppModule {
}
