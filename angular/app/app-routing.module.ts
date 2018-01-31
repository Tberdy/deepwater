import {NgModule} from '@angular/core';
import {Routes, RouterModule} from '@angular/router';

import {ChatComponent} from './chat/chat.component';

const routes: Routes = [{
    path: '',
    loadChildren: 'app/modules/home/home.module#HomeModule'
},
{
    path: 'login',
    loadChildren: 'app/modules/login/login.module#LoginModule'
},
{
    path: 'register',
    loadChildren: 'app/modules/register/register.module#RegisterModule'
},
{
    path: 'my-account',
    loadChildren: 'app/modules/my-account/my-account.module#MyAccountModule'
},
{
    path: 'chat',
    component: ChatComponent,
}];



@NgModule({
    imports: [RouterModule.forRoot(routes)],
    exports: [RouterModule]
})
export class AppRoutingModule {}
