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
        return this.get(this.apiBaseUrl);
    }

    getDevice(id: number) {
        return this.get(this.apiBaseUrl + '/' + id);
    }
    
    addDevice(device: Device) {
        return this.post(this.apiBaseUrl, JSON.stringify(device));
    }
    
    putDevice(device: Device) {
        return this.put(this.apiBaseUrl + '/' + device.id, JSON.stringify(device));
    }
    
    deleteDevice(device: Device) {
        return this.delete(this.apiBaseUrl + '/' + device.id);
    }

}
