import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import {AuthGuard} from '../../services/auth-guard.service';

import {ContestsComponent} from '../../components/contests/contests.component';
import { ContestDetailsComponent } from '../../components/contest-details/contest-details.component';

const routes: Routes = [{
    path: '',
    canActivate: [AuthGuard],
    component: ContestsComponent,
},
{
    path: ':id',
    canActivate: [AuthGuard],
    component: ContestDetailsComponent,
}];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class ContestsRoutingModule { }
