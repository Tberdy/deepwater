import {Member} from './member';

export class Device {
    id: number;
    member: Member;
    serial: string;
    description: string;
    trusted: boolean;
    
    constructor() {
        this.trusted = false;
    }
}