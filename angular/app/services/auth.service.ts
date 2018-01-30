import {Injectable} from '@angular/core';
import {HttpClient, HttpHeaders} from '@angular/common/http';
import 'rxjs/add/operator/toPromise';

import {ApiResponse} from '../models/api-response';
import {Credentials} from '../models/credentials';

@Injectable()
export class AuthService {
    private user = {
        id: '',
        email: '',
        token: '',
        logged: false
    };

    getUser() {
        return this.user;
    }

    constructor(private http: HttpClient) {
    }

    login(email: string, password: string) {
        this.http.post('/api/members/login', {email, password}, {headers: new HttpHeaders({'Accept': 'application/json', })}).toPromise()
            .then((response: ApiResponse) => {
                if (response.success) this.logUser(response.data);
                console.log(response);
            });
    }

    logUser(credentials: Credentials) {
        this.user.token = credentials.token;
        this.user.id = credentials.member.id;
        this.user.email = credentials.member.email;
        this.user.logged = true;
    }

}
