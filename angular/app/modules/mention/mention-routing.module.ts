import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import {AuthGuard} from '../../services/auth-guard.service';

import {MentionComponent} from '../../components/mention/mention.component';

const routes: Routes = [{
    path: '',
    canActivate: [AuthGuard],
    component: MentionComponent,
}];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class ContactRoutingModule { }
