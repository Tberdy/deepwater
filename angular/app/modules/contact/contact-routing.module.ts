import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import {AuthGuard} from '../../services/auth-guard.service';

import {ContactComponent} from '../../components/contact/contact.component';

const routes: Routes = [{
    path: '',
    canActivate: [AuthGuard],
    component: ContactComponent,
}];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class ContactRoutingModule { }
