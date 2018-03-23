import {Component, ViewChild, OnInit} from '@angular/core';
import {MatPaginator, MatSort, MatTableDataSource, MatDialog} from '@angular/material';
import {MatSlideToggleChange} from '@angular/material/slide-toggle';

import {DeviceFormDialog} from '../../dialogs/device-form/device-form.component';
import {ConfirmDialog} from '../../dialogs/confirm/confirm.component';

import {Device} from '../../models/device';

import {DeviceService} from '../../services/device.service';

@Component({
    selector: 'app-devices',
    templateUrl: './devices.component.html',
    styleUrls: ['./devices.component.css']
})
export class DevicesComponent implements OnInit {
    displayedColumns = ['description', 'serial', 'trusted', 'actions'];
    dataSource: MatTableDataSource<Device>;

    devices: Device[];

    @ViewChild(MatPaginator) paginator: MatPaginator;
    @ViewChild(MatSort) sort: MatSort;

    constructor(
        private deviceService: DeviceService,
        public dialog: MatDialog
    ) {
        this.dataSource = new MatTableDataSource(this.devices);
    }

    ngOnInit() {
        this.deviceService.getDevices()
            .then((devices: Device[]) => {
                this.devices = devices;
                this.refreshTable();
            }).catch(() => {
                //this.snackBar.open('Invalid credentials !', 'OK', {duration: 5000});
                //this.snackBar.open('Internal error', 'OK', {duration: 5000});
            });
    }

    /**
     * Set the paginator and sort after the view init since this component will
     * be able to query its view for the initialized paginator and sort.
     */
    ngAfterViewInit() {
        this.dataSource.paginator = this.paginator;
        this.dataSource.sort = this.sort;
    }

    applyFilter(filterValue: string) {
        filterValue = filterValue.trim(); // Remove whitespace
        filterValue = filterValue.toLowerCase(); // Datasource defaults to lowercase matches
        this.dataSource.filter = filterValue;
    }

    formDialog(action: string, device: Device | null): void {
        let params: any = {
            disableClose: true,
            width: '500px'
        };

        switch (action) {
            case 'add':
                params.data = {
                    device: new Device,
                    action: 'add'
                };
                break;
            case 'edit':
                params.data = {
                    device: device,
                    action: 'edit'
                };
                break;
        }

        let dialogRef = this.dialog.open(DeviceFormDialog, params);

        dialogRef.afterClosed().subscribe(result => {
            if (result) {
                switch (action) {
                    case 'add':
                        this.deviceService.addDevice(result)
                            .then((device: Device) => {
                                this.devices.push(device);
                                this.refreshTable();
                            }).catch(() => {
                                console.log('Errot while adding device');
                            });
                        break;
                    case 'edit':
                        this.deviceService.putDevice(result)
                            .then((device: Device) => {
                                this.updateDeviceInTable(device);
                            }).catch(() => {
                                console.log('Errot while adding device');
                            });
                        break;
                }
            }
        });
    }

    trustedDialog(event: MatSlideToggleChange, id: number, trusted: boolean): void {
        let device = new Device;
        device.id = id;
        device.trusted = !trusted;
        
        let params: any = {
            disableClose: true,
            width: '500px',
            data: {
                title: 'Confirmation',
                content: (device.trusted) ? 'Etes vous sûr de vouloir autoriser cet appareil ?' : 'Etes vous sûr de vouloir supprimer l\'autorisation de cet appareil ?'
            }
        };

        let dialogRef = this.dialog.open(ConfirmDialog, params);

        dialogRef.afterClosed().subscribe(result => {
            if (result) {
                this.deviceService.putDevice(device)
                    .then((device: Device) => {
                        this.updateDeviceInTable(device);
                    }).catch(() => {
                        console.log('Error while updating device');
                    });
            } else {
                event.source.checked = !event.source.checked;
            }
        });
    }

    refreshTable() {
        this.dataSource = new MatTableDataSource(this.devices);
        this.dataSource.paginator = this.paginator;
        this.dataSource.sort = this.sort;
    }

    deleteDevice(device: Device) {
        let dialogRef = this.dialog.open(ConfirmDialog, {
            disableClose: true,
            data: {
                title: 'Etes vous sûr de vouloir supprimer ça ?',
                content: 'Séance "' + device.description + '"'
            }
        });

        dialogRef.afterClosed().subscribe(result => {
            console.log('The dialog was closed');
            if (result) {
                this.deviceService.deleteDevice(device.id).then(() => {
                    this.removeDeviceFromTable(device.id);
                }).catch(() => {
                    console.log('Error while deleting device.');
                });
            }
        });
    }

    updateDeviceInTable(updateDevice: Device) {
        let array_index = this.devices.findIndex(device => device.id == updateDevice.id);
        this.devices[array_index] = updateDevice;
        this.refreshTable();
    }

    removeDeviceFromTable(id: number) {
        let array_index = this.devices.findIndex(device => device.id == id);
        this.devices.splice(array_index, 1);
        this.refreshTable();

    }

}
