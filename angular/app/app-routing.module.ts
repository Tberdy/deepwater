import {NgModule} from '@angular/core';
import {Routes, RouterModule} from '@angular/router';

import {AuthGuard} from './services/auth-guard.service';
import {AuthService} from './services/auth.service';

const routes: Routes = [{
    path: '',
    loadChildren: 'app/modules/home/home.module#HomeModule'
},
{
    path: 'account',
    loadChildren: 'app/modules/account/account.module#AccountModule'
},
{
    path: 'social',
    canActivate: [AuthGuard],
    loadChildren: 'app/modules/social/social.module#SocialModule'
},
{
    path: 'workouts',
    canActivate: [AuthGuard],
    loadChildren: 'app/modules/workouts/workouts.module#WorkoutsModule'
},
{
    path: 'devices',
    canActivate: [AuthGuard],
    loadChildren: 'app/modules/devices/devices.module#DevicesModule'
}];



@NgModule({
    imports: [RouterModule.forRoot(routes)],
    exports: [RouterModule],
    providers: [AuthGuard, AuthService]
})
export class AppRoutingModule {}
