import {NgModule} from '@angular/core';
import {CommonModule} from '@angular/common';

import {FlexLayoutModule} from '@angular/flex-layout'
import {MatButtonModule, MatInputModule, MatIconModule} from '@angular/material'

import {LoginRoutingModule} from './login-routing.module';
import {LoginComponent} from './login.component';

@NgModule({
    imports: [
        CommonModule,
        LoginRoutingModule,
        FlexLayoutModule,
        MatButtonModule, MatInputModule, MatIconModule
    ],
    declarations: [LoginComponent]
})
export class LoginModule {}
