import {NgModule} from '@angular/core';
import {Routes, RouterModule} from '@angular/router';

import {AuthGuard} from './services/auth-guard.service';
import {AuthService} from './services/auth.service';

const routes: Routes = [{
    path: '',
    loadChildren: 'app/modules/home/home.module#HomeModule'
},
{
    path: 'mention',
    loadChildren: 'app/modules/mention/mention.module#MentionModule'
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
},
{
    path: 'contact',
    canActivate: [AuthGuard],
    loadChildren: 'app/modules/contact/contact.module#ContactModule'
},
{
    path: 'wall',
    canActivate: [AuthGuard],
    loadChildren: 'app/modules/wall/wall.module#WallModule'
},
{
    path: 'contests',
    canActivate: [AuthGuard],
    loadChildren: 'app/modules/contests/contests.module#ContestsModule'
},
{
    path: 'ranking',
    canActivate: [AuthGuard],
    loadChildren: 'app/modules/ranking/ranking.module#RankingModule'
}];



@NgModule({
    imports: [RouterModule.forRoot(routes)],
    exports: [RouterModule],
    providers: [AuthGuard, AuthService]
})
export class AppRoutingModule {}
