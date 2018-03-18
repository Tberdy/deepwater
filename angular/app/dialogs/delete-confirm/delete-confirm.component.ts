import {Component, Inject} from '@angular/core';

import {MatDialogRef, MAT_DIALOG_DATA} from '@angular/material';

@Component({
    selector: 'delete-confirm',
    templateUrl: './delete-confirm.component.html',
    styleUrls: ['./delete-confirm.component.css']
})
export class DeleteConfirmDialog {

    constructor(
        public dialogRef: MatDialogRef<DeleteConfirmDialog>,
        @Inject(MAT_DIALOG_DATA) public data: any
    ) {}

    close(response: boolean) {
        this.dialogRef.close(response);
    }
}
