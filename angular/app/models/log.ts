import {Member} from './member';
import {Workout} from './workout';
import {Device} from './device';

export class Log {
    id: number;
    member: Member;
    workout: Workout;
    device: Device;
    date: string;
    location_latitude: number;
    location_longitude: number;
    log_type: string
    log_value: number;
}
