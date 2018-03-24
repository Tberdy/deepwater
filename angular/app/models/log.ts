import {Member} from './member';
import {Device} from './device';

export class Log {
    id: number;
    member: Member;
    workout_id: number;
    device_id: number;
    device: Device;
    date: string;
    location_latitude: number;
    location_longitude: number;
    log_type: string
    log_value: number;
}
