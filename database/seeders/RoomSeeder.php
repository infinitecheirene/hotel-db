<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;

class RoomSeeder extends Seeder
{
    public function run()
    {
        $rooms = [
            [
                'name' => 'Deluxe Single Room',
                'type' => 'single',
                'price' => 150.00,
                'description' => 'Perfect for solo travelers, featuring a comfortable queen bed and modern amenities.',
                'amenities' => ['Free WiFi', 'Air Conditioning', 'Mini Bar', 'Room Service', 'Flat Screen TV'],
                'image' => '/deluxe-single-room.jpg',
                'images' => ['/deluxe-single-room.jpg', '/standard-double-room.jpg'],
                'available' => true,
                'max_guests' => 2,
                'size' => 25,
                'location' => 'Makati City'
            ],
            [
                'name' => 'Superior Single Room',
                'type' => 'single',
                'price' => 120.00,
                'description' => 'Cozy single room with all essential amenities for a comfortable stay.',
                'amenities' => ['Free WiFi', 'Air Conditioning', 'Room Service', 'Flat Screen TV'],
                'image' => '/superior-single-room.jpg',
                'images' => ['/superior-single-room.jpg', '/standard-double-room.jpg'],
                'available' => true,
                'max_guests' => 2,
                'size' => 25,
                'location' => 'Makati City'
            ],
            [
                'name' => 'Standard Double Room',
                'type' => 'double',
                'price' => 200.00,
                'description' => 'Spacious double room perfect for couples with a king-size bed and city views.',
                'amenities' => ['Free WiFi', 'Air Conditioning', 'Mini Bar', 'Room Service', 'Flat Screen TV', 'City View'],
                'image' => '/standard-double-room.jpg',
                'images' => ['/standard-double-room.jpg', '/deluxe-double-room.jpg'],
                'available' => true,
                'max_guests' => 3,
                'size' => 35,
                'location' => 'Makati City'
            ],
            [
                'name' => 'Deluxe Double Room',
                'type' => 'double',
                'price' => 250.00,
                'description' => 'Luxurious double room with premium amenities and stunning city panorama.',
                'amenities' => ['Free WiFi', 'Air Conditioning', 'Mini Bar', 'Room Service', 'Flat Screen TV', 'City View', 'Balcony'],
                'image' => '/deluxe-double-room.jpg',
                'images' => ['/deluxe-double-room.jpg', '/executive-suite.jpg'],
                'available' => false,
                'max_guests' => 3,
                'size' => 35,
                'location' => 'Makati City'
            ],
            [
                'name' => 'Executive Suite',
                'type' => 'suite',
                'price' => 400.00,
                'description' => 'Spacious suite with separate living area, perfect for business travelers and extended stays.',
                'amenities' => ['Free WiFi', 'Air Conditioning', 'Mini Bar', 'Room Service', 'Flat Screen TV', 'City View', 'Balcony', 'Work Desk', 'Sofa'],
                'image' => '/executive-suite.jpg',
                'images' => ['/executive-suite.jpg'],
                'available' => true,
                'max_guests' => 4,
                'size' => 55,
                'location' => 'Makati City'
            ],
            [
                'name' => 'Presidential Suite',
                'type' => 'suite',
                'price' => 600.00,
                'description' => 'The ultimate luxury experience with premium amenities and personalized service.',
                'amenities' => ['Free WiFi', 'Air Conditioning', 'Mini Bar', 'Room Service', 'Flat Screen TV', 'City View', 'Balcony', 'Work Desk', 'Sofa', 'Jacuzzi', 'Butler Service'],
                'image' => '/luxury-hotel-spa-and-wellness-center.jpg',
                'images' => ['/luxury-hotel-spa-and-wellness-center.jpg', '/executive-suite.jpg'],
                'available' => true,
                'max_guests' => 4,
                'size' => 55,
                'location' => 'Makati City'
            ]
        ];

        foreach ($rooms as $room) {
            Room::create($room);
        }
    }
}