import {Component, ViewChild, OnInit} from '@angular/core';
import {MatPaginator, MatSort, MatTableDataSource, MatDialog} from '@angular/material';

import {ConfirmDialog} from '../../dialogs/confirm/confirm.component';

import {Contest} from '../../models/contest';
import {ContestService} from '../../services/contest.service';

@Component({
    selector: 'app-contests',
    templateUrl: './contests.component.html',
    styleUrls: ['./contests.component.css']
})
export class ContestsComponent implements OnInit {
    displayedColumns = ['name', 'type', 'description'];
    dataSource: MatTableDataSource<Contest>;

    contests: Contest[];

    @ViewChild(MatPaginator) paginator: MatPaginator;
    @ViewChild(MatSort) sort: MatSort;

    constructor(private contestService: ContestService,
        public dialog: MatDialog) {
            this.dataSource = new MatTableDataSource(this.contests);
            
        }

    ngOnInit() {
        this.contestService.getContests()
            .then((contests: Contest[]) => {
                this.contests = contests;
                
                this.refreshTable();
            }).catch(() => {
                //this.snackBar.open('Invalid credentials !', 'OK', {duration: 5000});
                //this.snackBar.open('Internal error', 'OK', {duration: 5000});
            });
    }
    refreshTable() {
        this.dataSource = new MatTableDataSource(this.contests);
        this.dataSource.paginator = this.paginator;
        this.dataSource.sort = this.sort;
    }
    deleteContest(contest: Contest) {
        let dialogRef = this.dialog.open(ConfirmDialog, {
            disableClose: true,
            data: {
                title: 'Etes vous sûr de vouloir supprimer ça ?',
                content: 'Compétition "' + contest.description + '"'
            }
        });

        dialogRef.afterClosed().subscribe(result => {
            console.log('The dialog was closed');
            if (result) {
                this.contestService.deleteContest(contest.id).then(() => {
                    this.removeContestFromTable(contest.id);
                }).catch(() => {
                    console.log('Error while deleting contest.');
                });
            }
        });
    }
    
    updateContestInTable(updateContest: Contest) {
        let array_index = this.contests.findIndex(contest => contest.id == updateContest.id); 
        this.contests[array_index] = updateContest;
        this.refreshTable();
    }

    removeContestFromTable(id: number) {
        let array_index = this.contests.findIndex(contest => contest.id == id);
        this.contests.splice(array_index, 1);
        this.refreshTable();

    }
    applyFilter(filterValue: string) {
        filterValue = filterValue.trim(); // Remove whitespace
        filterValue = filterValue.toLowerCase(); // Datasource defaults to lowercase matches
        this.dataSource.filter = filterValue;
    }

}
