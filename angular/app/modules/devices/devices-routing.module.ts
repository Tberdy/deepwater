import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import {AuthGuard} from '../../services/auth-guard.service';

import {DevicesComponent} from '../../components/devices/devices.component';

const routes: Routes = [{
    path: '',
    canActivate: [AuthGuard],
    component: DevicesComponent,
}];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class DevicesRoutingModule { }
