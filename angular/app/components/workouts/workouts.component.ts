import {Component, ViewChild, OnInit} from '@angular/core';
import {MatPaginator, MatSort, MatTableDataSource} from '@angular/material';

import {Workout} from '../../models/workout'

import {WorkoutService} from '../../services/workout.service'

@Component({
    selector: 'app-workouts',
    templateUrl: './workouts.component.html',
    styleUrls: ['./workouts.component.css']
})
export class WorkoutsComponent implements OnInit {
    displayedColumns = ['description', 'date', 'end_date', 'location_name', 'sport'];
    dataSource: MatTableDataSource<Workout>;
    workouts: Workout[];

    @ViewChild(MatPaginator) paginator: MatPaginator;
    @ViewChild(MatSort) sort: MatSort;

    constructor(
        private workoutService: WorkoutService
    ) {
        this.dataSource = new MatTableDataSource(this.workouts);
    }

    ngOnInit() {
        this.workoutService.getWorkouts()
            .then((workouts: Workout[]) => {
                this.workouts = workouts;
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
}
