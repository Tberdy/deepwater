import {NgModule} from '@angular/core';
import {CommonModule} from '@angular/common';

import {DevicesRoutingModule} from './devices-routing.module';

import {DeviceService} from '../../services/device.service';

import {DevicesComponent} from '../../components/devices/devices.component';

@NgModule({
    imports: [
        CommonModule,
        DevicesRoutingModule
    ],
    declarations: [
        DevicesComponent,
    ],
    providers: [DeviceService],
})
export class DevicesModule {}
