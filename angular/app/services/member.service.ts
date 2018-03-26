import {Injectable} from '@angular/core';
import {HttpClient} from '@angular/common/http';
import 'rxjs/add/operator/toPromise';

import {RestApi} from '../lib/rest-api';

import {AuthService} from '../services/auth.service';

import {Member} from '../models/member';

@Injectable()
export class MemberService extends RestApi {

    constructor(http: HttpClient, authService: AuthService) {
        super(http, authService);
        this.apiBaseUrl = '/api/members';
    }

    getMembers() {
        return this.get(this.apiBaseUrl);
    }

    getMember(id: string) {
        return this.get(this.apiBaseUrl + '/' + id);
    }
    
    addMember(member: Member) {
        return this.post(this.apiBaseUrl, JSON.stringify(member));
    }
    
    putMember(member: Member) {
        return this.put(this.apiBaseUrl + '/' + member.id, JSON.stringify(member));
    }
    
    deleteMember(member: Member) {
        return this.delete(this.apiBaseUrl + '/' + member.id);
    }

}
