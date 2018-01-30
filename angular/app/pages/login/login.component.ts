import {Component, OnInit} from '@angular/core';
import {Router} from '@angular/router';

import {AuthService} from '../../services/auth.service';

@Component({
    selector: 'app-login',
    templateUrl: './login.component.html',
    styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {

    hide = true;

    login() {
        console.log('yo');
        this.authService.login('yo@mamene.fr', 'corecore');
    }

    ngOnInit() {
    }

    constructor(
        private router: Router,
        private authService: AuthService) {

    }

}
