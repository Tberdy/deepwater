import {Injectable} from '@angular/core';
import {HttpClient} from '@angular/common/http';
import 'rxjs/add/operator/toPromise';

import {RestApi} from '../lib/rest-api';

import {AuthService} from '../services/auth.service';

import {Earning} from '../models/earning';

@Injectable()
export class EarningService extends RestApi {

    constructor(http: HttpClient, authService: AuthService) {
        super(http, authService);
        this.apiBaseUrl = '/api/members/' + this.authService.getUser().id + '/earnings';
    }

    getEarnings() {
        return this.get(this.apiBaseUrl);
    }

    getEarning(id: number) {
        return this.get(this.apiBaseUrl + '/' + id);
    }
    
    addEarning(earning: Earning) {
        return this.post(this.apiBaseUrl, JSON.stringify(earning));
    }
    
    putEarning(earning: Earning) {
        return this.put(this.apiBaseUrl + '/' + earning.id, JSON.stringify(earning));
    }
    
    deleteEarning(earning: Earning) {
        return this.delete(this.apiBaseUrl + '/' + earning.id);
    }

}
