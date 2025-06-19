target_x , target_y


self.firebase.save_log("info", "Choosing side...")
turned_angle = -90 if sensor_data["us_4"] > sensor_data["us_3"] else 90
self.turn(turned_angle)
target_yaw = mpu_angle_glob

while True:
    self._calculate_distance_cm()
    current_yaw = mpu_angle_glob
    
    # Yaw correction
    yaw_error = (current_yaw - target_yaw + 540) % 360 - 180
    correction = 15 * yaw_error
    correction = max(correction, -20)
    correction = min(correction, 20)
    
    # Adjust wheel speeds
    leftSpeed = speed + correction
    rightSpeed = speed - correction
    print(f"{yaw_error} , {correction} , {leftSpeed} , {rightSpeed}")

    leftSpeed = max(min(leftSpeed, CONFIG['max_speed']), -CONFIG['max_speed'])
    rightSpeed = max(min(rightSpeed, CONFIG['max_speed']), -CONFIG['max_speed'])

    self.car.set_wheel_speeds(leftSpeed, rightSpeed)
    
    if sensor_data["us_3"] > 100:
        self.move(30, speed)
        break
    time.sleep(CONFIG['update_interval'])
self.car.set_wheel_speeds(0, 0)
obs_moved_distance = self.total_distance - obs_moved_distance
print(f"Moved {obs_moved_distance:.1f} cm to avoid obstacle")
self.turn(-turned_angle)