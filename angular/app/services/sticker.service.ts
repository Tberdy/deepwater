import { Injectable } from '@angular/core';
import {HttpClient} from '@angular/common/http';
import 'rxjs/add/operator/toPromise';

import {RestApi} from '../lib/rest-api';

import {AuthService} from '../services/auth.service';

import {Sticker} from '../models/sticker';

@Injectable()
export class StickerService extends RestApi {

    constructor(http: HttpClient, authService: AuthService) {
        super(http, authService);
        this.apiBaseUrl = '/api/stickers';
    }

    getStickers() {
        return this.get(this.apiBaseUrl);
    }

    getSticker(id: number) {
        return this.get(this.apiBaseUrl + '/' + id);
    }
    
    addSticker(sticker: Sticker) {
        return this.post(this.apiBaseUrl, JSON.stringify(sticker));
    }
    
    putSticker(sticker: Sticker) {
        return this.put(this.apiBaseUrl + '/' + sticker.id, JSON.stringify(sticker));
    }
    
    deleteSticker(sticker: Sticker) {
        return this.delete(this.apiBaseUrl + '/' + sticker.id);
    }

}
