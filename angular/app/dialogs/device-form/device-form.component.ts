import {Component, Inject} from '@angular/core';

import {MatDialogRef, MAT_DIALOG_DATA} from '@angular/material';

import {Device} from '../../models/device';

@Component({
    selector: 'device-form',
    templateUrl: './device-form.component.html',
    styleUrls: ['./device-form.component.css'],
})
export class DeviceFormDialog {
    
    device: Device

    constructor(
        public dialogRef: MatDialogRef<DeviceFormDialog>,
        @Inject(MAT_DIALOG_DATA) public data: any
    ) {
        this.device = data.device;
    }

    close(): void {
        this.dialogRef.close();
    }
    
    submit() {
        this.dialogRef.close(this.device);
    }

}
