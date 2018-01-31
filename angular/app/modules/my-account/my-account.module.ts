import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { MyAccountRoutingModule } from './my-account-routing.module';
import {MyAccountComponent} from '../../components/my-account/my-account.component';

@NgModule({
  imports: [
    CommonModule,
    MyAccountRoutingModule
  ],
  declarations: [MyAccountComponent]
})
export class MyAccountModule { }
