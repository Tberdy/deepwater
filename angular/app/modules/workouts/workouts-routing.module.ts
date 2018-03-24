import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import {AuthGuard} from '../../services/auth-guard.service';

import {WorkoutsComponent} from '../../components/workouts/workouts.component';


const routes: Routes = [{
    path: '',
    canActivate: [AuthGuard],
    component: WorkoutsComponent,
}];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class WorkoutsRoutingModule { }
