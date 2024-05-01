import { Component } from '@angular/core';
import { RouterOutlet } from '@angular/router';
import { DeviceEventTableComponent } from './device-event-table/device-event-table.component';
import { HttpClientModule } from  '@angular/common/http';

@Component({
  selector: 'app-root',
  standalone: true,
  imports: [RouterOutlet, HttpClientModule, DeviceEventTableComponent],
  templateUrl: './app.component.html',
  styleUrl: './app.component.css'
})
export class AppComponent {
  
}
