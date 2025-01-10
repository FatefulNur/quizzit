"use client";

import { useState } from "react";
import {
	Grid,
	List,
	SortAsc,
	SortDesc,
	Plus,
	FileText,
	MoreHorizontalIcon,
	ExternalLinkIcon,
	EditIcon,
	Trash2Icon,
} from "lucide-react";

import { Button } from "@/shadcn/ui/button";
import { AspectRatio } from "@/shadcn/ui/aspect-ratio";
import { Card, CardContent } from "@/shadcn/ui/card";
import {
	Select,
	SelectContent,
	SelectItem,
	SelectTrigger,
	SelectValue,
} from "@/shadcn/ui/select";
import {
	DropdownMenu,
	DropdownMenuContent,
	DropdownMenuItem,
	DropdownMenuTrigger,
} from "@/shadcn/ui/dropdown-menu";
import {
	Table,
	TableBody,
	TableCell,
	TableHead,
	TableHeader,
	TableRow,
} from "@/shadcn/ui/table";
import AppLayout from "@/Layouts/AppLayout";

const templates = [
	{
		title: "Blank Form",
		description: "Start with a clean slate",
		icon: "✏️",
		color: "bg-blue-100",
	},
	{
		title: "Contact Information",
		description: "Collect personal details",
		icon: "📇",
		color: "bg-green-100",
	},
	{
		title: "Event RSVP",
		description: "Manage event attendance",
		icon: "🎉",
		color: "bg-purple-100",
	},
	{
		title: "Customer Feedback",
		description: "Gather user opinions",
		icon: "🗣️",
		color: "bg-yellow-100",
	},
];

const recentForms = Array.from({ length: 8 }, (_, i) => ({
	id: i + 1,
	title: `Form ${i + 1}`,
	lastModified: new Date(Date.now() - Math.random() * 10000000000),
	lastOpenedByMe: new Date(Date.now() - Math.random() * 10000000000),
	lastModifiedByMe: new Date(Date.now() - Math.random() * 10000000000),
	color: ["bg-blue-100", "bg-green-100", "bg-yellow-100", "bg-purple-100"][
		Math.floor(Math.random() * 4)
	],
}));

export default function Home() {
	const [view, setView] = useState("grid");
	const [sortBy, setSortBy] = useState("lastModified");
	const [sortOrder, setSortOrder] = useState("desc");

	const groupForms = (forms) => {
		if (sortBy === "title") return { "All Forms": forms };
		const now = new Date();
		const sevenDaysAgo = new Date(now.getTime() - 7 * 24 * 60 * 60 * 1000);
		const thirtyDaysAgo = new Date(
			now.getTime() - 30 * 24 * 60 * 60 * 1000
		);
		return forms.reduce((groups, form) => {
			const date =
				form[
				sortBy === "lastOpenByMe"
					? "lastOpenedByMe"
					: sortBy === "lastModifyByMe"
						? "lastModifiedByMe"
						: "lastModified"
				];
			if (date > sevenDaysAgo) {
				groups["Previous 7 days"] = [
					...(groups["Previous 7 days"] || []),
					form,
				];
			} else if (date > thirtyDaysAgo) {
				groups["Previous 30 days"] = [
					...(groups["Previous 30 days"] || []),
					form,
				];
			} else {
				groups["Older"] = [...(groups["Older"] || []), form];
			}
			return groups;
		}, {});
	};

	const sortedForms = [...recentForms].sort((a, b) => {
		let comparison = 0;
		switch (sortBy) {
			case "lastOpenByMe":
				comparison =
					a.lastOpenedByMe.getTime() - b.lastOpenedByMe.getTime();
				break;
			case "lastModifyByMe":
				comparison =
					a.lastModifiedByMe.getTime() - b.lastModifiedByMe.getTime();
				break;
			case "lastModified":
				comparison =
					a.lastModified.getTime() - b.lastModified.getTime();
				break;
			case "title":
				comparison = a.title.localeCompare(b.title);
				break;
		}
		return sortOrder === "asc" ? comparison : -comparison;
	});

	return (
		<AppLayout>
			<div className="space-y-16 p-8">
				<section className="space-y-4">
					<h1 className="text-3xl font-bold tracking-tight">
						Create, Share, and Analyze with Ease
					</h1>
					<div className="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
						{templates.map((template) => (
							<Card
								key={template.title}
								className="group relative overflow-hidden transition-all hover:shadow-lg"
							>
								<CardContent className={`flex h-full flex-col items-center justify-center p-6 text-center ${template.color}`}>
									<div className="mb-4 text-4xl">
										{template.icon}
									</div>
									<h3 className="mb-2 text-lg font-semibold">
										{template.title}
									</h3>
									<p className="text-sm text-muted-foreground">
										{template.description}
									</p>
									<Button
										className="mt-4 opacity-0 transition-opacity group-hover:opacity-100"
										variant="secondary"
									>
										Use Template
									</Button>
								</CardContent>
							</Card>
						))}
					</div>
					<div className="flex justify-center">
						<Button variant="outline" className="gap-2">
							<Plus className="h-4 w-4" />
							Create Custom Template
						</Button>
					</div>
				</section>
				<section>
					<div className="mb-6 flex items-center justify-between">
						<h2 className="text-2xl font-semibold tracking-tight">
							Recent forms
						</h2>
						<div className="flex items-center space-x-2">
							<Select
								value={sortBy}
								onValueChange={(value) => setSortBy(value)}
							>
								<SelectTrigger className="w-[180px]">
									<SelectValue placeholder="Sort by" />
								</SelectTrigger>
								<SelectContent>
									<SelectItem value="lastOpenByMe">
										Last opened by me
									</SelectItem>
									<SelectItem value="lastModifyByMe">
										Last modified by me
									</SelectItem>
									<SelectItem value="lastModified">
										Last modified
									</SelectItem>
									<SelectItem value="title">Title</SelectItem>
								</SelectContent>
							</Select>
							<Button
								variant="outline"
								size="icon"
								onClick={() =>
									setSortOrder((prev) =>
										prev === "asc" ? "desc" : "asc"
									)
								}
							>
								{sortOrder === "asc" ? (
									<SortAsc className="h-4 w-4" />
								) : (
									<SortDesc className="h-4 w-4" />
								)}
							</Button>
							<Button
								variant="outline"
								size="icon"
								onClick={() =>
									setView(view === "grid" ? "list" : "grid")
								}
							>
								{view === "grid" ? (
									<Grid className="h-4 w-4" />
								) : (
									<List className="h-4 w-4" />
								)}
							</Button>
						</div>
					</div>
					{Object.entries(groupForms(sortedForms)).map(
						([group, forms]) => (
							<div key={group} className="mb-8">
								<h3 className="mb-4 text-lg font-medium">
									{group}
								</h3>
								{view === "grid" ? (
									<div className="grid gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
										{forms.map((form) => (
											<Card key={form.id} className="overflow-hidden transition-all hover:shadow-md">
												<div className="relative">
													<div className="absolute top-1 right-2 z-40">

														<DropdownMenu>
															<DropdownMenuTrigger asChild>
																<Button
																	variant="ghost"
																	size="icon"
																>
																	<MoreHorizontalIcon className="h-4 w-4" />
																	<span className="sr-only">Open menu</span>
																</Button>
															</DropdownMenuTrigger>
															<DropdownMenuContent align="end">
																<DropdownMenuItem>
																	<ExternalLinkIcon className="size-4 mr-2" />
																	Open
																</DropdownMenuItem>
																<DropdownMenuItem>
																	<EditIcon className="size-4 mr-2" />
																	Edit
																</DropdownMenuItem>
																<DropdownMenuItem>
																	<Trash2Icon className="size-4 mr-2" />
																	Delete
																</DropdownMenuItem>
															</DropdownMenuContent>
														</DropdownMenu>
													</div>
													<AspectRatio ratio={4 / 3} className="bg-muted">
														<img
															src="/placeholder.svg?height=400&width=300"
															alt="Form preview"
															className="w-full h-full object-cover"
														/>
													</AspectRatio>
												</div>
												<CardContent className="p-4">
													<div className="flex items-center gap-2">
														<FileText className="h-5 w-5 text-primary" />
														<h3 className="font-medium truncate flex-1">{form.title}</h3>
													</div>
													<div className="flex items-center justify-between">
														<p className="flex-1 text-sm text-muted-foreground mt-1">
															Modified {form.lastModified.toLocaleTimeString([], { hour: 'numeric', minute: '2-digit' })}
														</p>
													</div>
												</CardContent>
											</Card>
										))}
									</div>
								) : (
									<Table>
										<TableHeader>
											<TableRow>
												<TableHead className="w-[100px]">
													Icon
												</TableHead>
												<TableHead>Title</TableHead>
												<TableHead>
													Last Modified
												</TableHead>
												<TableHead className="text-right">
													Actions
												</TableHead>
											</TableRow>
										</TableHeader>
										<TableBody>
											{forms.map((form) => (
												<TableRow key={form.id}>
													<TableCell>
														<FileText className="h-5 w-5 text-muted-foreground" />
													</TableCell>
													<TableCell className="font-medium min-w-52">
														{form.title}
													</TableCell>
													<TableCell>
														{form.lastModified.toLocaleDateString()}
													</TableCell>
													<TableCell className="text-right">
														<DropdownMenu>
															<DropdownMenuTrigger asChild>
																<Button
																	variant="ghost"
																	size="icon"
																>
																	<MoreHorizontalIcon className="h-4 w-4" />
																	<span className="sr-only">Open menu</span>
																</Button>
															</DropdownMenuTrigger>
															<DropdownMenuContent align="end">
																<DropdownMenuItem>
																	<ExternalLinkIcon className="size-4 mr-2" />
																	Open
																</DropdownMenuItem>
																<DropdownMenuItem>
																	<EditIcon className="size-4 mr-2" />
																	Edit
																</DropdownMenuItem>
																<DropdownMenuItem>
																	<Trash2Icon className="size-4 mr-2" />
																	Delete
																</DropdownMenuItem>
															</DropdownMenuContent>
														</DropdownMenu>
													</TableCell>
												</TableRow>
											))}
										</TableBody>
									</Table>
								)}
							</div>
						)
					)}
				</section>
			</div>
		</AppLayout>
	);
}
