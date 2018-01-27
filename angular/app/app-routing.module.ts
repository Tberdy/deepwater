import {NgModule} from '@angular/core';
import {Routes, RouterModule} from '@angular/router';

const routes: Routes = [{
    path: '',
    loadChildren: 'app/home/home.module#HomeModule'
},
{
    path: 'login',
    loadChildren: 'app/login/login.module#LoginModule'
},
{
    path: 'my-account',
    loadChildren: 'app/my-account/my-account.module#MyAccountModule'
}];



@NgModule({
    imports: [RouterModule.forRoot(routes)],
    exports: [RouterModule]
})
export class AppRoutingModule {}
