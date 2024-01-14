<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoryData = [
            'Web Development' => 'Create responsive and dynamic websites using the latest web technologies.',
            'Mobile App Development' => 'Build innovative mobile applications for iOS and Android platforms.',
            'Data Science' => 'Extract valuable insights from data to drive informed decision-making.',
            'Artificial Intelligence' => 'Develop intelligent systems that can mimic human-like cognitive functions.',
            'Cybersecurity' => 'Protect systems, networks, and programs from digital attacks and unauthorized access.',
            'Blockchain' => 'Implement decentralized and secure solutions using blockchain technology.',
            'DevOps' => 'Bridge the gap between development and operations for efficient and reliable software delivery.',
            'Cloud Computing' => 'Deploy and manage scalable applications in cloud environments.',
            'Game Development' => 'Create engaging and immersive gaming experiences for various platforms.',
            'UI/UX Design' => 'Design user interfaces and experiences to enhance user satisfaction and usability.',
            'IT & Networking' => 'Build and maintain robust IT infrastructures and networks.',
            'Database Administration' => 'Manage and optimize databases to ensure efficient data storage and retrieval.',
            'E-commerce Development' => 'Develop online shopping platforms for seamless and secure transactions.',
            'Digital Marketing' => 'Promote products and services through digital channels to reach a wider audience.',
            'Software Testing' => 'Ensure the quality and reliability of software through comprehensive testing processes.',
            'Tech Support' => 'Provide technical assistance and support to resolve user issues and inquiries.',
            'Tech Writing' => 'Create clear and concise technical documentation for software and systems.',
            'API Development' => 'Design and implement APIs to enable seamless communication between software applications.',
            'Automation' => 'Streamline processes and workflows through the implementation of automated solutions.',
            'Machine Learning' => 'Develop algorithms and models that enable systems to learn and improve from experience.',
            'Augmented Reality' => 'Integrate digital information with the user’s environment for enhanced experiences.',
            'Virtual Reality' => 'Create immersive and interactive virtual environments for various applications.',
            'IoT (Internet of Things)' => 'Build and connect smart devices to enable data exchange and automation.',
            'Big Data' => 'Manage and analyze large volumes of data to extract meaningful insights.',
            'Embedded Systems' => 'Design and develop embedded systems for specific applications and functions.',
            'Robotics' => 'Create intelligent machines capable of performing tasks autonomously.',
            'Computer Vision' => 'Enable machines to interpret and understand visual information.',
            'Quantum Computing' => 'Explore and develop applications harnessing the power of quantum mechanics.',
            '3D Printing' => 'Use additive manufacturing techniques to create three-dimensional objects.',
        ];

        foreach ($categoryData as $categoryName => $categoryDescription) {
            Category::create([
                'name' => $categoryName,
                'slug' => \Illuminate\Support\Str::slug($categoryName),
                'description' => $categoryDescription,
            ]);
        }
        
    }
}
