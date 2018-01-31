import {NgModule} from '@angular/core';
import {CommonModule} from '@angular/common';

import {FlexLayoutModule} from '@angular/flex-layout';
import {FormsModule} from '@angular/forms';
import {MatButtonModule, MatInputModule, MatIconModule, MatSnackBarModule} from '@angular/material';

import {RegisterRoutingModule} from './register-routing.module';
import {RegisterComponent} from '../../components/register/register.component';

@NgModule({
    imports: [
        CommonModule,
        RegisterRoutingModule,
        FlexLayoutModule,
        FormsModule,
        MatButtonModule, MatInputModule, MatIconModule, MatSnackBarModule
    ],
    declarations: [RegisterComponent]
})
export class RegisterModule {}
