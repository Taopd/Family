//
//  ViewController.m
//  Strategy
//
//  Created by TaoPD on 12/14/15.
//  Copyright © 2015 TaoPD. All rights reserved.
//

#import "ViewController.h"
#import "Context.h"
#import "Addition.h"
//#import "Subtraction.h"

@interface ViewController ()

@end

@implementation ViewController

- (void)viewDidLoad {
    [super viewDidLoad];
    Context *context = [Context new];
    context.strategy = [Addition new];
    
//    NSInteger result = [context calculate:10 and:5];
    
//    NSLog(@"result: %ld", (long)result);
    
//    NSInteger result = [calculator calculate];
}

- (void)didReceiveMemoryWarning {
    [super didReceiveMemoryWarning];
    // Dispose of any resources that can be recreated.
}

@end
