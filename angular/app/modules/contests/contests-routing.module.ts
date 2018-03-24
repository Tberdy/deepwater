import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import {AuthGuard} from '../../services/auth-guard.service';

import {ContestsComponent} from '../../components/contests/contests.component';

const routes: Routes = [{
    path: '',
    canActivate: [AuthGuard],
    component: ContestsComponent,
}];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class ContestsRoutingModule { }
