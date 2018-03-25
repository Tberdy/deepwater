import {Injectable} from '@angular/core';
import {HttpClient} from '@angular/common/http';
import 'rxjs/add/operator/toPromise';

import {RestApi} from '../lib/rest-api';

import {AuthService} from '../services/auth.service';

import {Log} from '../models/log';

@Injectable()
export class LogService extends RestApi {

    constructor(http: HttpClient, authService: AuthService) {
        super(http, authService);
    }

    init(workout_id: number) {
        this.apiBaseUrl = '/api/members/' + this.authService.getUser().id + '/workouts/' + workout_id + '/logs';
    }

    getLogs() {
        return this.http.get<Log[]>(this.apiBaseUrl, {headers: this.getHeaders()}).toPromise();;
    }

    getLog(id: number) {
        return this.http.get<Log>(this.apiBaseUrl + '/' + id, {headers: this.getHeaders()}).toPromise();;
    }

    addLog(log: Log) {
        if (log.device) {
            log.device_id = log.device.id;
            delete log.device;
        }
        
        return this.http.post<Log>(this.apiBaseUrl, JSON.stringify(log), {headers: this.getHeaders()}).toPromise();
    }

    putLog(log: Log) {
        log.device_id = log.device.id;
        delete log.device;
        return this.http.put<Log>(this.apiBaseUrl + '/' + log.id, JSON.stringify(log), {headers: this.getHeaders()}).toPromise();
    }

    deleteLog(id: number) {
        return this.http.delete(this.apiBaseUrl + '/' + id, {headers: this.getHeaders()}).toPromise();
    }

}
