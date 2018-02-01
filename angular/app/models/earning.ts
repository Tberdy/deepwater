import {Member} from './member';
import {Sticker} from './sticker';

export class Device {
    id: number;
    member: Member;
    sticker: Sticker;
    date: string;
}