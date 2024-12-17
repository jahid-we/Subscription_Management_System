export default function GraphSection() {
    return (
        <>
            <div>
                <h2 className="font-medium mb-6">Total subscriptions</h2>
                <div className="bg-custom-dark-purple rounded-lg p-6">
                    <div className="text-sm text-gray-400 mb-4">
                        Annual Subscriptions
                    </div>
                    <div className="relative h-[200px]">
                        {/*Y-axis labels*/}
                        <div className="absolute left-0 h-full flex flex-col justify-between text-xs text-gray-400">
                            <span>0s</span>
                            <span>5s</span>
                            <span>10s</span>
                            <span>15s</span>
                            <span>20s</span>
                        </div>

                        {/*Grid lines*/}
                        <div className="absolute inset-0 flex flex-col justify-between">
                            <div className="border-t border-gray-700"></div>
                            <div className="border-t border-gray-700"></div>
                            <div className="border-t border-gray-700"></div>
                            <div className="border-t border-gray-700"></div>
                            <div className="border-t border-gray-700"></div>
                        </div>

                        {/*Bars */}
                        {/*<div className="absolute inset-0 ml-8 flex items-end justify-between">*/}
                        {/*    <div*/}
                        {/*        className="w-8 bg-purple-600/30 rounded-t-lg"*/}
                        {/*        style="height: 90%"*/}
                        {/*    ></div>*/}
                        {/*    <div*/}
                        {/*        className="w-8 bg-purple-600/30 rounded-t-lg"*/}
                        {/*        style="height: 20%"*/}
                        {/*    ></div>*/}
                        {/*    <div*/}
                        {/*        className="w-8 bg-purple-600/30 rounded-t-lg"*/}
                        {/*        style="height: 70%"*/}
                        {/*    ></div>*/}
                        {/*    <div*/}
                        {/*        className="w-8 bg-purple-600/30 rounded-t-lg"*/}
                        {/*        style="height: 40%"*/}
                        {/*    ></div>*/}
                        {/*    <div*/}
                        {/*        className="w-8 bg-purple-600/30 rounded-t-lg"*/}
                        {/*        style="height: 60%"*/}
                        {/*    ></div>*/}
                        {/*    <div*/}
                        {/*        className="w-8 bg-purple-600/30 rounded-t-lg"*/}
                        {/*        style="height: 80%"*/}
                        {/*    ></div>*/}
                        {/*    <div*/}
                        {/*        className="w-8 bg-purple-600/30 rounded-t-lg"*/}
                        {/*        style="height: 50%"*/}
                        {/*    ></div>*/}
                        {/*    <div*/}
                        {/*        className="w-8 bg-purple-600/30 rounded-t-lg"*/}
                        {/*        style="height: 30%"*/}
                        {/*    ></div>*/}
                        {/*    <div*/}
                        {/*        className="w-8 bg-purple-600/30 rounded-t-lg"*/}
                        {/*        style="height: 45%"*/}
                        {/*    ></div>*/}
                        {/*    <div*/}
                        {/*        className="w-8 bg-purple-600/30 rounded-t-lg"*/}
                        {/*        style="height: 65%"*/}
                        {/*    ></div>*/}
                        {/*    <div*/}
                        {/*        className="w-8 bg-purple-600/30 rounded-t-lg"*/}
                        {/*        style="height: 55%"*/}
                        {/*    ></div>*/}
                        {/*    <div*/}
                        {/*        className="w-8 bg-purple-600/30 rounded-t-lg"*/}
                        {/*        style="height: 35%"*/}
                        {/*    ></div>*/}
                        {/*</div>*/}
                        {/*X-axis labels*/}
                        <div className="absolute bottom-0 left-8 right-0 flex justify-between text-xs text-gray-400 pt-4">
                            <span>Jan</span>
                            <span>Feb</span>
                            <span>Mar</span>
                            <span>Apr</span>
                            <span>May</span>
                            <span>Jun</span>
                            <span>Jul</span>
                            <span>Aug</span>
                            <span>Sep</span>
                            <span>Oct</span>
                            <span>Nov</span>
                            <span>Dec</span>
                        </div>
                    </div>
                </div>
            </div>
        </>
    );
}
