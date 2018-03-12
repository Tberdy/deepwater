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
        this.apiBaseUrl = '/api/members/' + this.authService.getUser().id + '/logs';
    }

    getLogs() {
        return this.get(this.apiBaseUrl);
    }

    getLog(id: number) {
        return this.get(this.apiBaseUrl + '/' + id);
    }
    
    addLog(log: Log) {
        return this.post(this.apiBaseUrl, JSON.stringify(log));
    }
    
    putLog(log: Log) {
        return this.put(this.apiBaseUrl + '/' + log.id, JSON.stringify(log));
    }
    
    deleteLog(log: Log) {
        return this.delete(this.apiBaseUrl + '/' + log.id);
    }

}
