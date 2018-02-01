import {Injectable} from '@angular/core';
import {HttpClient, HttpHeaders} from '@angular/common/http';
import 'rxjs/add/operator/toPromise';

import {Credentials} from '../models/credentials';

@Injectable()
export class AuthService {
    private user = {
        id: '',
        email: '',
        token: '',
        logged: false
    };
    
    redirectUrl = '';
    
    constructor(private http: HttpClient) {
    }

    getUser() {
        return this.user;
    }

    isLogged(): boolean {
        return this.user.logged;
    }

    login(email: string, password: string) {
        return this.http.post('/api/members/login', {email: email, password: password}, {headers: new HttpHeaders({'Accept': 'application/json', })}).toPromise();
    }

    register(email: string, password: string) {
        return this.http.post('/api/members/register', {email: email, password: password}, {headers: new HttpHeaders({'Accept': 'application/json', })}).toPromise();
    }
    
    logout(): void {
        this.user.token = '';
        this.user.id = '';
        this.user.email = '';
        this.user.logged = false;
    }

    logUser(credentials: Credentials): void {
        this.user.token = credentials.token;
        this.user.id = credentials.member.id;
        this.user.email = credentials.member.email;
        this.user.logged = true;
    }

}
