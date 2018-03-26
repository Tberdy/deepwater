import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import {AuthGuard} from '../../services/auth-guard.service';

import {RankingComponent} from '../../components/ranking/ranking.component';

const routes: Routes = [{
    path: '',
    canActivate: [AuthGuard],
    component: RankingComponent,
}];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class RankingRoutingModule { }
