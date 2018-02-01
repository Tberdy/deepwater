import {HttpClient, HttpHeaders} from '@angular/common/http';
import 'rxjs/add/operator/toPromise';

import {AuthService} from '../services/auth.service';

import {ApiResponse} from '../models/api-response';

export abstract class RestApi {
    
    protected apiBaseUrl: string;
        
    getHeaders(): HttpHeaders {
        if (this.authService.isLogged()) {
            return new HttpHeaders({'Accept': 'application/json', 'Authorization': 'Bearer ' + this.authService.getUser().token});
        } else {
            return new HttpHeaders({'Accept': 'application/json'});
        }
    }
    
    constructor(protected http: HttpClient, protected authService: AuthService) {}
    
    protected get(url: string) {
        return this.http.get(url, {headers: this.getHeaders()}).toPromise();
    }
    
    protected post(url: string, body: {}) {
        return this.http.post(url, body, {headers: this.getHeaders()}).toPromise();
    }
    
    protected put(url: string, body: {}) {
        return this.http.put(url, body, {headers: this.getHeaders()}).toPromise();
    }
    
    protected delete(url: string) {
        return this.http.delete(url, {headers: this.getHeaders()}).toPromise();
    }
}


