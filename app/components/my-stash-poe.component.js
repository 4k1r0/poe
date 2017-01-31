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
var poe_api_service_1 = require("../services/poe-api.service");
var MyStashPoeComponent = (function () {
    function MyStashPoeComponent(poeApiService) {
        this.poeApiService = poeApiService;
    }
    MyStashPoeComponent.prototype.onClick = function () {
        console.log('onclick');
        this.poeApiService.crawl();
    };
    MyStashPoeComponent = __decorate([
        core_1.Component({
            moduleId: module.id,
            selector: 'my-stash-poe',
            templateUrl: './my-stash-poe.component.html'
        }), 
        __metadata('design:paramtypes', [poe_api_service_1.PoeApiService])
    ], MyStashPoeComponent);
    return MyStashPoeComponent;
}());
exports.MyStashPoeComponent = MyStashPoeComponent;
//# sourceMappingURL=my-stash-poe.component.js.map