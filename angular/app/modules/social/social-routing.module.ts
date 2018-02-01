import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import {AuthGuard} from '../../services/auth-guard.service';

import {ChatComponent} from '../../components/chat/chat.component';
import {WallComponent} from '../../components/wall/wall.component';
import {FriendsComponent} from '../../components/friends/friends.component';

const routes: Routes = [{
    path: 'chat',
    canActivate: [AuthGuard],
    component: ChatComponent,
},
{
    path: '',
    canActivate: [AuthGuard],
    component: WallComponent,
},
{
    path: 'friends',
    canActivate: [AuthGuard],
    component: FriendsComponent,
}];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class SocialRoutingModule { }
