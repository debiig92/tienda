import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { URL_SERVICIOS } from '../config/url.services';

@Injectable()
export class ProductosProvider {

  pagina:number = 0;
  productos:any[] = [];
  constructor(public http: HttpClient) {
    this.cargar_todos();
  }

  cargar_todos() {
    let url = URL_SERVICIOS + 'cargarAllProducts';

    //new Angular HttpClient service
    this.http.get(url)
      .subscribe(data => {   // data is already a JSON object
          console.log(data);
          this.productos.push(data["result"]);
          this.pagina += 1;

      });

      console.log(this.productos);
  }
}
