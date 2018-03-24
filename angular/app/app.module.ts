import {BrowserModule} from '@angular/platform-browser';
import {NgModule} from '@angular/core';
import {BrowserAnimationsModule} from '@angular/platform-browser/animations';
import {FlexLayoutModule} from '@angular/flex-layout';
import {HttpClientModule} from '@angular/common/http';

import {MatButtonModule} from '@angular/material/button';

import {AppRoutingModule} from './app-routing.module';
import {AuthService} from './services/auth.service';

import {AppComponent} from './app.component';
import {HeaderComponent} from './components/header/header.component';
import {FooterComponent} from './components/footer/footer.component';

import {ConfirmDialog} from './dialogs/confirm/confirm.component';



@NgModule({
    declarations: [
        AppComponent,
        HeaderComponent,
        FooterComponent,
        ConfirmDialog,
    ],
    imports: [
        BrowserModule,
        AppRoutingModule,
        BrowserAnimationsModule,
        FlexLayoutModule,
        HttpClientModule,
        MatButtonModule

    ],
    entryComponents: [
        ConfirmDialog,
    ],
    providers: [AuthService],
    bootstrap: [AppComponent]
})
export class AppModule {}
