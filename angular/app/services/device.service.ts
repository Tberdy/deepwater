import {Injectable} from '@angular/core';
import {HttpClient} from '@angular/common/http';
import 'rxjs/add/operator/toPromise';

import {RestApi} from '../lib/rest-api';

import {AuthService} from '../services/auth.service';

import {Device} from '../models/device';

@Injectable()
export class DeviceService extends RestApi {

    constructor(http: HttpClient, authService: AuthService) {
        super(http, authService);
        this.apiBaseUrl = '/api/members/' + this.authService.getUser().id + '/devices';
    }

    getDevices() {
        return this.http.get<Device[]>(this.apiBaseUrl, {headers: this.getHeaders()}).toPromise();
    }

    getDevice(id: number) {
        return this.http.get<Device>(this.apiBaseUrl + '/' + id, {headers: this.getHeaders()}).toPromise();
    }
    
    addDevice(device: Device) {
        return this.http.post<Device>(this.apiBaseUrl, JSON.stringify(device), {headers: this.getHeaders()}).toPromise();
    }
    
    putDevice(device: Device) {
        return this.http.put<Device>(this.apiBaseUrl + '/' + device.id, JSON.stringify(device), {headers: this.getHeaders()}).toPromise();
    }
    
    deleteDevice(id: number) {
        return this.http.delete(this.apiBaseUrl + '/' + id, {headers: this.getHeaders()}).toPromise();
    }

}
